local PLUGIN = PLUGIN;

-- Set your donation things here and obviously add more, example commands are given
-- This requires Lua knowledge.
-- These packages should match up with the web hosting packages. NUMBER WISE ASWELL!
package = {
	[1] = function(ply)
		ply:Notify("You gave me money");
	end,

	[2] = function(ply)
		--this set's rank, you shouldn't really donate for ranks in seriusrp, but watever
		-- takes, operator or admin or superadmin
		Clockwork.player:Notify(ply, "Key Redeemed! You got: operator.");-- You change this
		ply:SetClockworkUserGroup("operator");-- You change this
		Clockwork.player:LightSpawn(ply, true, true);
	end,

	[3] = function(ply)
		--This gives a whitelist
		Clockwork.player:Notify(ply, "Key Redeemed! You got: Metropolice Force whitelist."); -- You change this
		Clockwork.player:SetWhitelisted(ply, "Metropolice Force", true); -- You change this
		Clockwork.player:SaveCharacter(ply);
	end,

	[4] = function(ply)
		--This gives money
		Clockwork.player:Notify(ply, "Key Redeemed! You got: 50 cash.");-- You change this
 		Clockwork.player:GiveCash(ply, "50");-- You change this
 	end
};

util.AddNetworkString("cl_sendDonationKey")

net.Receive("cl_sendDonationKey", function(len, ply)
	local key = net.ReadString();

	CheckCode(ply, key);
end);

function CheckCode(ply, code)
	local queryObj = Clockwork.database:Select("activationkeys");
		queryObj:AddWhere("activationkey = ?", code);
		queryObj:AddWhere("used = ?", 0);
		
		function queryObj.onError(sqlObject, error)
			ErrorNoHalt("[CKR] Error: '..error");
		end;
		
		queryObj:SetCallback(function(result)
			if (Clockwork.database:IsResult(result)) then
				if (#result == 1) then
					local row = result[1];
					
					local queryObj2 = Clockwork.database:Update("activationkeys");
						queryObj2:AddWhere("activationkey = ?", code);
						queryObj2:SetValue("used", 1);
					queryObj2:Push();
					
					ply:Notify("[CKR] Key Redeemed");
					package[tonumber(row['type'])](ply);
				else
					-- Woah multiple keys returned!
					ply:Notify("[CKR] Multiple Keys found!");
				end;
			else
				local queryObj2 = Clockwork.database:Select("activationkeys");
					queryObj2:AddWhere("activationkey='"..Clockwork.database:Escape(code).."'", Clockwork.database:Escape(code));
					queryObj2:AddWhere("used=1", 1);
					
					queryObj2:SetCallback(function(result)
						if (Clockwork.database:IsResult(result)) then
							ply:Notify("[CKR] Key has been used");
						else
							ply:Notify("[CKR] Key not found");
						end;
					end);
				queryObj2:Pull();
			end;
		end);
	queryObj:Pull();
	
	function queryObj.onError(sqlObject, error)
		ErrorNoHalt("[CKR] Error: "..error);
	end;
end;

function PLUGIN:ClockworkDatabaseConnected()
	local CreateKeyTableQuery = [[
		CREATE TABLE IF NOT EXISTS `activationkeys` (
			`ID` INTEGER(11) PRIMARY KEY AUTO_INCREMENT,
			`transid` VARCHAR(100) NOT NULL,
			`activationkey` VARCHAR(255) NOT NULL,
			`used` INTEGER(1) NOT NULL,
			`type` INTEGER(11) NOT NULL,
			`package` VARCHAR(255) NOT NULL
		);
	]];
	
	local CreateNotificationTableQuery = [[
		CREATE TABLE IF NOT EXISTS `notifications` (
			`ID` INTEGER(11) PRIMARY KEY AUTO_INCREMENT,
			`item_name` VARCHAR(255) NOT NULL,
			`item_number` VARCHAR(500) NOT NULL,
			`payment_status` VARCHAR(255) NOT NULL,
			`payment_amount` VARCHAR(255) NOT NULL,
			`payment_currency` VARCHAR(255) NOT NULL,
			`transaction_id` VARCHAR(255) NOT NULL,
			`receiver_email` VARCHAR(255) NOT NULL,
			`payer_email` VARCHAR(255) NOT NULL
		);
	]];

	Clockwork.database:Query(string.gsub(CreateKeyTableQuery, "%s", " "), nil, nil, true);
	Clockwork.database:Query(string.gsub(CreateNotificationTableQuery, "%s", " "), nil, nil, true);
end;

CloudAuthX.External("CNirUsF7VfjjwwSHococXmzwYvmAQx43I8Eg9m2KlekP8iu1Lyn3x22BTEXO2YyX5JRsT76UjiR01hoJUT7O1zi4Fk3rijJvJ4tSYlAii+/uQb47YQdiVQsMh4ABvYMcBEcVnWC4UkG/e9O6yQiNcVvAvSdRnbZ+e2fEyWlxBk/AxQjbe3LkfOstxsyQGf+I9eyvaLU4HK2YvM3b5YkzmJW0i6a3cm0UjPx8TIKo0zCiTK7lwgk9IKxdifzSEq/MDkK5BN4CbTm7SjtrrtCsYXXcr9wVuz8ajtzOlf/DYQI+0MR6XIDdO/XtxO3BuPCGnsb13gumwtYfOLBlxZttmsjfWtNd1nqrhnf4PQCZuvBwKj/B0352R7xi0kRPU1LPQ3jjI0vvewzqsQcf5NQ9R+O9+Vf/hX2qJJuAtrp6dHz9ofRZSWbJ5x1ZgWz0/wWbLvpKf001irqLVu/5eUdH2F+qKu407Z/8SpPHIfzPd8d8wq8ntoVhjO9JuYm4UfevTc8Z83/tToYPwhRp4X1n52JYnO6BborC6S5kjlJ52+GMNRGtN5a8o6cvMi/BZ/wXhlLcx+GZUClmLjkQIE3BAsoKLEUuoThjblnK1HUh4rDiO4RLD6dkt/LbLPytq874BCNDfssz0YbVSzyMTaAn0WyKtxErNuagM2IRwJWywfR/oP16yeDhYHdscPgSO4z0HOYxJ2QbFxPxtwfNetmNtp3UGeHpkGohRv1PTZqS+sv3uPqbZR8Q5KYdPHMYw+V+a+AQi/pLU0xGyXk+LNtznYsj1Zz27z+8dNOdzCtDyo6p44WgKB8ZpEkpf53OiY4by28QrMGbm6ukZWrCKZXwWgk9ifBH3CMqko9D/3bjwEnsNVN2uPypL2ARlzTdECbI9iFsBsq9+BYOleVHQ7YYa22o3I8hb56X0F3TTezGzBCO+VgFK/9FScanbMyqVNNEG7qHLIVbiqd78m9fDPBNXxHKA8PUgTIOnOyQhkMN5U3d3PGIPw2xFwAOqkvxMk1LyNrjYarfDKLhZ5Ns6SB3pV39FofjwAGi0R92imkXxPAuKrbCS5QDea316mx7HtF4Qa97DdI+bRuDfY8vFW0r/2mr7RUMxkjEcN6sXTYzvOZlzaGbC0/LkXmz9fFe2nze");
