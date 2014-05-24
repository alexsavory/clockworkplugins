local PLUGIN = PLUGIN;
local SCHEMA = SCHEMA;
local Clockwork = Clockwork;

require( "mysqloo" )

-- Set your donation things here and obviously add more, example commands are given
-- This requires LUA knowledge.
-- These packages should match up with the web hosting packages. NUMBER WISE ASWELL!
package={}

package[1]= function(ply)

		ply:ChatPrint('You gave me money')
end

package[2]= function(ply)
		--this set's rank, you shouldn't really donate for ranks in seriusrp, but watever
		-- takes, operator or admin or superadmin
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: operator.");-- You change this
		target:SetClockworkUserGroup("operator");-- You change this
		Clockwork.player:LightSpawn(target, true, true);
end

package[3]= function(ply)
		--This gives a whitelist
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: Metropolice Force whitelist."); -- You change this
		Clockwork.player:SetWhitelisted(target, "Metropolice Force", true); -- You change this
		Clockwork.player:SaveCharacter(target);
end

package[4]= function(ply)
		--This gives money
		nick = ply:Nick()
		local target = Clockwork.player:FindByID(nick)
		Clockwork.player:Notify(target, "Key Redeemed! You got: 50 cash.");-- You change this
 		Clockwork.player:GiveCash(target, "50");-- You change this
end




function truConnectDatabase()
	db = mysqloo.connect( "127.0.0.1", "root", "", "donations", 3306 )
	function db:onConnected()
		print( "[CKR] Database has connected!" )
	end
	function db:onConnectionFailed( err )
		print( "[CKR] Connection to database failed!" )
		print( "[CKR] Error:", err )
	end
	db:connect()
end

	hook.Add("Initialize", "truConnectDatabase", truConnectDatabase)



	util.AddNetworkString("cl_sendDonationKey")

	net.Receive("cl_sendDonationKey", function(len,ply)
		local key = net.ReadString()
		CheckCode(ply,key)
	end)

	
function CheckCode(ply,code)
	local codequery = db:query("SELECT * FROM activationkeys WHERE activationkey='" .. db:escape(code) .. "' AND used=0")		
	codequery.onSuccess = function() -- Needs the callback for when the Query is completed | Even if there are no results to show
	local data = codequery:getData()
	local row = data[1]
		if (#data == 1) then -- If there is 1 Row (Table) returned for the Query
			-- Update database first, incase it errors
			local updatekey = db:query("UPDATE activationkeys SET used=1 WHERE activationkey='"..code.."' AND used=0")
			-- If it's successful redeem!
			updatekey.onSuccess = function()
				print('[CKR] Key Redeemed')
				package[tonumber(row['type'])](ply)
			end-- key update success
			updatekey.onError = function(db, err,ply)
				print('[CKR] Error! :', err)
				ply:ChatPrint('There was a error redeeming your key. Contact Owner')
			end -- update error
			updatekey:start()
			elseif (#data > 1) then
			-- Woah multiple keys returned!
			print('[CKR] Multiple Keys found! Error:', err)
			ply:ChatPrint('There was a error redeeming your key. Contact Owner')
		end -- if returned 1
		if (#data == 0) then
			print('[CKR] Key not found')
			ply:ChatPrint('No code found')
		end
	end --find key onsuccess
		codequery.onError = function(db, err,ply) -- Callback for an error that occurs during the Query.
			print('[CKR] Error! :', err) 
			ply:ChatPrint('There was a error redeeming your key. Contact Owner')
		end
		
	codequery:start()
		
end




