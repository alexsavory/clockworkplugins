local PLUGIN = PLUGIN;

	--[[
	
	I honestly could not think of another way to do this.
	edit line 40 to change times
	Credits go to Rj for inital design.
	To add more, add the line to the random sounds, then add another if statement
	]]--
function PLUGIN:EmitRandomChatter(player)
	local randomSounds = {
		"npc/overwatch/cityvoice/f_innactionisconspiracy_spkr.wav",
		"npc/overwatch/cityvoice/f_trainstation_offworldrelocation_spkr.wav",
		"npc/overwatch/cityvoice/fprison_missionfailurereminder.wav"
	};
	

	
	local randomSound = randomSounds[ math.random(1, #randomSounds) ];
		if(randomSound == "npc/overwatch/cityvoice/f_innactionisconspiracy_spkr.wav") then
			Clockwork.chatBox:Add(nil, player, "dispatch", "Citizen reminder. Inaction is conspiracy. Report counter behaviour to a Civil Protection team immediately.");
		end
		if(randomSound == "npc/overwatch/cityvoice/f_trainstation_offworldrelocation_spkr.wav") then
			Clockwork.chatBox:Add(nil, player, "dispatch", "Citizen notice. Failure to co-operate will result in permanent off-world relocation");
		end
		if(randomSound == "npc/overwatch/cityvoice/fprison_missionfailurereminder.wav") then
			Clockwork.chatBox:Add(nil, player, "dispatch", "Attention ground units. Mission failure will result in permanent off-world assignment. Code reminder: SACRIFICE, COAGULATE, PLAN.");
		end
		
	player:EmitSound( randomSound, 60)
end;

-- Called each tick.
function PLUGIN:Tick()
	for k, v in ipairs( _player.GetAll() ) do
		
			local curTime = CurTime();
			
			if (!self.nextChatterEmit) then
				self.nextChatterEmit = curTime + math.random(120, 150);
			end;
			
			if ( (curTime >= self.nextChatterEmit) ) then
				self.nextChatterEmit = nil;
				
				PLUGIN:EmitRandomChatter(v);
			end;

	end;
end;