	--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

--[[
	You don't have to do this, but I think it's nicer.
	Alternatively, you can simply use the PLUGIN variable.
--]]


--[[ You don't have to do this either, but I prefer to seperate the functions. --]]
-- Names enabled?
local enablenames = true

-- Titles enabled?
local enabletitles = true

-- How to align the text?
-- 0 = left
-- 1 = center
-- 2 = right
local textalign = 1

-- Distance multiplier. The higher this number, the further away you'll see names and titles.
local distancemulti = 2

function DrawStatus()

	local vStart = LocalPlayer():GetPos()
	local vEnd

	for k, v in pairs(player.GetAll()) do

		local vStart = LocalPlayer():GetPos()
		local vEnd = v:GetPos() + Vector(0,0,40)
		local trace = {}
		
		trace.start = vStart
		trace.endpos = vEnd
		local trace = util.TraceLine( trace )
		
		if trace.HitWorld then
			--Do nothing!
		else
			local mepos = LocalPlayer():GetPos()
			local tpos = v:GetPos()
			local tdist = mepos:Distance(tpos)
			
			if tdist <= 3000 then
				local zadj = 0.03334 * tdist
				local pos = v:GetPos() + Vector(0,0,v:OBBMaxs().z + 5 + zadj)
				pos = pos:ToScreen()
				
				local alphavalue = (600 * distancemulti) - (tdist/1.5)
				alphavalue = math.Clamp(alphavalue, 0, 255)
				
				local outlinealpha = (450 * distancemulti) - (tdist/2)
				outlinealpha = math.Clamp(outlinealpha, 0, 255)
				
				local playerstatus = v:GetNetworkedString("status")
				
				if ( (v != LocalPlayer()) and (v:GetNWBool("statusenabled") == true) ) then
						draw.SimpleTextOutlined(playerstatus, "Trebuchet18", pos.x, pos.y + 6, Color(255,255,255,alphavalue),textalign,1,1,Color(0,0,0,outlinealpha))
				end
			end
		end
	end
end
hook.Add("HUDPaint", "DrawNameTitle", DrawStatus)